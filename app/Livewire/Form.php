<?php
namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\JobCompletion;
use Illuminate\Support\Facades\Log;

class Form extends Component
{
    public $client, $project, $po, $status, $completion_date, $invoice;
    public $items = [];

    public function mount()
    {
        $this->items = [
            ['no' => 1, 'code' => '', 'description' => '', 'required_quantity' => '', 'supplied_quantity' => '', 'remark' => '']
        ];
    }

    public function addItem()
    {
        $this->items[] = ['code' => '', 'description' => '', 'required_quantity' => '', 'supplied_quantity' => '', 'remark' => ''];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Re-index array
    }

    public function generatePDF()
    {
        $data = [
            'client' => $this->client,
            'project' => $this->project,
            'po' => $this->po,
            'status' => $this->status,
            'completion_date' => $this->completion_date,
            'invoice' => $this->invoice,
            'items' => array_map(function($item, $index) {
                return array_merge($item, ['no' => $index + 1]); // Add 'no' key
            }, $this->items, array_keys($this->items)),
        ];

        try {
            // Generate PDF
            $pdf = Pdf::loadView('pdf.job-completion', $data);
            $filename = 'job_completion_' . time() . '.pdf';

            // Define the public directory where PDFs will be stored
            $pdfFolder = public_path('pdfs');

            // Save the PDF file
            $pdfPath = $pdfFolder . '/' . $filename;
            $pdf->save($pdfPath);

            // Generate a public URL
            $pdfUrl = asset('pdfs/' . $filename);

            // Dispatch event to notify UI
            $this->dispatch('pdfGenerated', $pdfUrl);

            // Save filename & details to the database
            $jobCompletion =  JobCompletion::create([
                'client' => $this->client,
                'project' => $this->project,
                'po' => $this->po,
                'status' => $this->status,
                'completion_date' => $this->completion_date,
                'invoice' => $this->invoice,
            ]);

            if (!$jobCompletion) {
                throw new \Exception("Database save failed.");
            }
    
            // Log success
            Log::info("Database record created successfully:", ['job_completion' => $jobCompletion]);
            // Log success
            Log::info("PDF generated successfully: " . $pdfUrl);

        } catch (\Exception $e) {
            // Log the error
            Log::error("Failed to generate PDF: " . $e->getMessage());

            // Flash error message to UI
            session()->flash('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.form', ['items' => $this->items]);
    }
}
