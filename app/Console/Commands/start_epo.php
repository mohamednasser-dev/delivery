<?php

namespace App\Console\Commands;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_student;
use App\Models\Notification;
use App\Models\Plan_episode_day;
use Carbon\Carbon;
use Illuminate\Console\Command;

class start_epo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notifiction to studdent before episode start';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $epo_notify = Episode_course_days::where('send_status','not_sended')->where('notify_at', '<', Carbon::now())->get();
        foreach ($epo_notify as $row){
            $epo = Episode::findOrFail($row->episode_id);

            //send to episode teacher ...
            $input_teacher['teacher_id'] = $epo->teacher_id;
            $input_teacher['type'] = 'teacher';
            $input_teacher['message_type'] = 'notify_start_epo';
            $input_teacher['title_ar'] = 'حلقاتى';
            $input_teacher['title_en'] = 'my_episodes';
            $input_teacher['message_ar'] = 'سوف تبدأ حلقة - '.$epo->name_ar.' _ الساعة '.date('Y-m-d g:i a', strtotime($row->started_at));
            $input_teacher['message_en'] = 'Episode - '.$epo->name_en.' - will start at '.date('Y-m-d g:i a', strtotime($row->started_at));
            Notification::create($input_teacher);

            //send to episode students ...
            $students = Episode_student::whereHas('Student')->where('episode_id',$row->episode_id)->get();
            foreach ($students as $student){
                $input_student['student_id'] = $student->student_id;
                $input_student['type'] = 'student';
                $input_student['message_type'] = 'notify_start_epo';
                $input_student['title_ar'] = 'حلقاتى';
                $input_student['title_en'] = 'my_episodes';
                $input_student['message_ar'] = 'سوف تبدأ حلقة - '.$epo->name_ar.' _ الساعة '.date('Y-m-d g:i a', strtotime($row->started_at));
                $input_student['message_en'] = 'Episode - '.$epo->name_en.' - will start at '.date('Y-m-d g:i a', strtotime($row->started_at));
                Notification::create($input_student);
            }
            $update_data['send_status'] = 'sended';
            Episode_course_days::find($row->id)->update($update_data);
        }
    }
}
