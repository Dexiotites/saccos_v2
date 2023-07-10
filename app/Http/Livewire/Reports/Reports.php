<?php

namespace App\Http\Livewire\Reports;

use App\Models\approvals;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Reports extends Component
{

    public $endDate;
    public $startDate;
    public $nodes;
    public $services;
    public $channels;
    public $type;

    public $showResolveModal = false;
    public $transactionToReview;
    public $comments;

    public $processorNodes;

    protected $listeners = [
        'resolveModal' => 'showResolveModal',
    ];

    public function showResolveModal($id){

    $this->transactionToReview = $id;
    $this->showResolveModal = true;

    }

    public function mount(): void
    {
        $this->endDate = "2025-07-31";
        $this->startDate = "2022-09-30";
        $this->nodes = array();
        $this->services = array();
        $this->channels = array();
        $this->type = array();
    }

    public function updatedStartDate($value): void
    {
        $this->startDate = $value;
        $this->emit('updatedStartDate', $value);
    }
    public function updatedEndDate($value): void
    {
        $this->endDate = $value;
        $this->emit('updatedEndDate', $value);
    }
    public function updatedNodes($value): void
    {
        $this->nodes = $value;
        $this->emit('updatedNodes', $value);
    }
    public function updatedServices($value): void
    {
        $this->services = $value;
        $this->emit('updatedServices', $value);
    }
    public function updatedChannels($value): void
    {
        $this->channels = $value;
        $this->emit('updatedChannels', $value);
    }
    public function updatedType($value): void
    {
        $this->type = $value;
        $this->emit('updatedType', $value);
    }

    public function updatedProcessorNodes($value): void
    {

       //dd($value);
        $this->type = $value;
        $this->emit('updatedProcessorType', $value);
    }


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.reports.reports');
    }


    public function saveResolution(){

        $rrn = Transactions::where('ID',$this->transactionToReview)->value('DB_TABLE_REFERENCE');

        $this->validate([

            'comments' => 'required|string|max:550'


        ]);

        $data = [

            'RECON_RESULTS'  => 'RESOLVED',
            'ACTION'  => 'RESOLVED',
            'COMMENTS'  => $this->comments

        ];


        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $this->transactionToReview,
                'user_id' => Auth::user()->id

            ],
            [
                'institution' => '',
                'process_name' => 'resolveTransaction',
                'process_description' => Auth::user()->name.' has requested to resolve a Non Matching Transaction with RN - '. $rrn.'. COMMENTS - '.$this->comments,
                'approval_process_description' => '',
                'process_code' => '22',
                'process_id' => $this->transactionToReview,
                'process_status' => 'PENDING',
                'approval_status' => 'PENDING',
                'user_id'  => Auth::user()->id,
                'team_id'  => '',
                'edit_package'=> json_encode($data),

            ]
        );
        Session::flash('message', 'Awaiting approval');
        Session::flash('alert-class', 'alert-success');

        sleep(3);
        $this->showResolveModal = false;

    }

    }
