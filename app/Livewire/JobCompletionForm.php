<?php 
namespace App\Http\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;


#[Layout('layout.app')]
class JobCompletionForm extends Component
{
    public $client, $project, $po, $status, $completion_date, $invoice;
    public $items = [];

    public function mount()
    {
        $this->items = [
            ['code' => '', 'description' => '', 'required_quantity' => '', 'supplied_quantity' => '', 'remark' => '']
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
        'items' => $this->items,
    ];

    $pdf = Pdf::loadView('pdf.job-completion', $data);
    $filename = 'job_completion_' . time() . '.pdf';

    // Save the PDF temporarily in storage
    Storage::put('public/' . $filename, $pdf->output());

    // Emit an event to notify the frontend
    $this->emit('pdfGenerated', asset('storage/' . $filename));
}

    public function render()
    {
        return view('livewire.job-completion-form');
    }
}
