<?php namespace Yfktn\ContactUs\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Session;
use AjaxException;
use Validator;
use yfktn\ContactUs\Models\ContactUs as ContactUsModel;
use Lang;

class ContactUs extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'yfktn.contactus::lang.components.contact_us_title',
            'description' => 'yfktn.contactus::lang.components.contact_us_description'
        ];
    }

    public function onRun()
    {
        $this->page['start_load'] = Carbon::now()->timestamp;
    }

    /**
     * Check if this user submit too fast, spammer?
     */
    protected function measureTheTimer(int $startTime)
    {
        $current = Carbon::now();
        $userStart = Carbon::createFromTimestamp($startTime);
        // let's assume if human cannot submit, faster than 5 second
        $isSpammer = 5000; // in milliseconds
        if($userStart->diffInRealMilliseconds($current) <= $isSpammer) {
            return 1;
        }
        return 0;
    }

    /**
     * Check if this user posting too fast after the last attempt.
     */
    protected function userThrottle($ipuser)
    {
        $current = Carbon::now();
        $maxDiff = 600; // in seconds
        // get last user from the same ip
        $last = ContactUsModel::where('ip', $ipuser)->orderBy('created_at', 'desc')->first();
        if($last === null) {
            return false;
        }
        
        if($last->created_at->diffInSeconds($current) <= $maxDiff) {
            return true;
        }

        return false;
    }

    public function onSubmit()
    {
        if(Session::token() != input("_token", "")) {
            throw new AjaxException(['#serverMsg' => $this->renderPartial('@errornya', [
                'errornya' => [ Lang::get('yfktn.contactus::lang.ui.error_token_security') ]
            ])]);
        }

        $currentIp = request()->ip();
        if($this->userThrottle($currentIp)) {
            throw new AjaxException(['#serverMsg' => $this->renderPartial('@errornya', [
                'errornya' => [ Lang::get('yfktn.contactus::lang.ui.error_throttle') ]
            ])]);
        }

        $flag = $this->measureTheTimer(input('author_start'));

        $data = [
            'author' => input('author'),
            'comment' => input('comment'),
            'email' => input('email'),
            'url' => input('url')
        ];
        // make validation
        $validator = Validator::make(
            $data,
            [
                'author' => 'required',
                'email' => 'required|email',
                'comment' => 'required|min:50'
            ]
        );

        if($validator->fails()) {
            $messages = $validator->messages();
            throw new AjaxException(['#serverMsg' => $this->renderPartial('@errorvalidation', [
                'errornya' => $messages->all()
            ])]);
        }

        $model = new ContactUsModel();
        $model->author = $data['author'];
        $model->email = $data['email'];
        $model->comment = $data['comment'];
        $model->website = $data['url'];
        $model->flagged = $flag;
        $model->ip = request()->ip();
        if(!$model->save()) {
            throw new AjaxException(['#serverMsg' => $this->renderPartial('@errornya', [
                'errornya' => [ Lang::get('yfktn.contactus::lang.ui.error_save') ]
            ])]);
        }
    }
}