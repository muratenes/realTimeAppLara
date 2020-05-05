<?php

namespace App\Http\Controllers;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function broadcastOn(){
        return new PresenceChannel('survey.' . $this->survey->id);
    }
}
