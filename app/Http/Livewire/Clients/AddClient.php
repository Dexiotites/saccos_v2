<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\ChannelsModel;
use App\Models\institutions;
use Livewire\WithFileUploads;

class AddClient extends Component
{


    use WithFileUploads;

    public $photo;

    public $admin;

    public $name;
    public $identifier;

    public $email;



    public $channels = array();
    public $channelsList = array();
    public $NewChannel;
    public $DB_TABLE_CLIENT_IDENTIFIER;
    public $tempArray = array();


    public function updatedNewChannel(){
        $this->channelsList[] = $this->NewChannel;
    }

    public function set(){

        $node = array(
            "channel_id" => $this->NewChannel,
            "client_identifier" => $this->DB_TABLE_CLIENT_IDENTIFIER
        );
        $this->tempArray[] = $node;
    }




    public function save()
    {

        institutions::create([
            'NAME'=>$this->name,
            'CHANNELS'=>json_encode($this->tempArray),
            'IDENTIFIER'=>'1',
            'STATUS'=>'ACTIVE'
        ]);

    }



    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->channels = ChannelsModel::get();
        return view('livewire.clients.add-client');
    }
}
