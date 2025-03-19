<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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
    
        $pdf = Pdf::loadView('pdf.job-completion', $data);
        $filename = 'job_completion_' . time() . '.pdf';
    
        // Save the PDF in the public folder so it can be accessed via URL
        $pdfPath = public_path($filename);
        $pdf->save($pdfPath);
    
        // Dispatch event to Alpine.js
        $this->dispatch('pdfGenerated', asset($filename));
    }
    

    public function render()
    {
        return view('livewire.form', ['items'=>$this->items]);
    }
}