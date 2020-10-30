<?php

namespace App\Listeners;

use App\Events\LessonAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Schedule;
use App\Models\Group;


class onLessonAdded
{

    public function __construct()
    {
        //
    }
    public function handle(LessonAdded $event)
    {
		switch ($event->lesson['day_of_week']){
			case "1":
				$event->lesson['day_of_week'] = "Понедельник";
				break;
			case "2":
				$event->lesson['day_of_week'] = "Вторник";
				break;
			case "3":
				$event->lesson['day_of_week'] = "Среда";
				break;
			case "4":
				$event->lesson['day_of_week'] = "Четверг";
				break;
			case "5":
				$event->lesson['day_of_week'] = "Пятница";
				break;
			case "6":
				$event->lesson['day_of_week'] = "Суббота";
				break;
			case "7":
				$event->lesson['day_of_week'] = "Воскресенье";
				break;
			default:
				$event->lesson['day_of_week'] = "Понедельник";
				break;
		}
        
		$group = Group::find($event->group->id);
		$group->schedule()->create($event->lesson);
    }
}
