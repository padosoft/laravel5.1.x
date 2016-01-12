<?php

/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 19/11/2015
 * Time: 10:19
 */

use Mockery as m;

class MailTest extends MailTestCase
{



    /** @test */
    public function it_send_s_an_email()
    {
        //Config::set('mail.port','222');
        //echo Config::get('mail.port');
        $this->deleteAllMails();
        $this->call('GET','emailtest');
        $emailHtml = $this->getLastEmailHtml();
        $emailJson = $this->getLastEmailJson();
        $this->assertEmailBodyContains('Welcome',$emailHtml);
        $this->assertEmailWasSentoTo('joe@example.com',$emailJson);
        //$this->call('GET','emailtest');
    }

    /*public function test_mockery_mail() {
        Mail::shouldReceive('send')->once()->andReturnUsing(function($viewName,$viewData,$closure) {
            $this->assertEquals('emails.welcome',$viewName);

            $message = m::mock('Illuminate\Mailer\Message');
            $message->shouldReceive('to')
                ->andReturnUsing(function($to,$alias){
                    $this->assertEquals('John Doe',$alias);
                });

            $message->shouldReceive('subject')
                ->andReturnUsing(function($subject){
                    $this->assertEquals('Welcome',$subject);
                });
            $closure($message);
            //return true;
        });
    }*/

}
