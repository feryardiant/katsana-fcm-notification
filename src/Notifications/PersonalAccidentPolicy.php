<?php

namespace NotificationChannels\Fcm\Notifications;

use Illuminate\Support\Str;
use NotificationChannels\Fcm\Message;

class PersonalAccidentPolicy extends Notification
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $topic;

    /**
     * @var string
     */
    protected $status;

    /**
     * @param string $status
     */
    public function __construct(string $status)
    {
        $this->status = $status;
        $this->topic = 'monthly-personal-accident-policy-'.Str::slug($status).'-notification';
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \NotificationChannels\Fcm\Message
     */
    public function toFcm($notifiable)
    {
        $data = [
            'type' => 'personal_accident',
            'status' => $this->status,
        ];

        return (new Message)
                    ->notification($this->title, $this->body)
                    ->topic($this->topic)
                    ->data($data);
    }

    /**
     * @return self
     */
    public static function claimable(): self
    {
        $notification = new self(__FUNCTION__);

        $notification->title = 'You received a reward!';
        $notification->body = 'Thanks for driving safe last month. Tap here to claim free Personal Accident insurance.';

        return $notification;
    }

    /**
     * @return self
     */
    public static function active(): self
    {
        $notification = new self(__FUNCTION__);

        $notification->title = 'PA Policy activated';
        $notification->body = 'Your complimentary Personal Accident insurance is active starting today.';

        return $notification;
    }

    /**
     * @param int $day
     * @return self
     */
    public static function toClaimRemindDay(int $day): self
    {
        $notification = new self(__FUNCTION__ . $day);
        
        switch ($day) {
            case 2:
                $notification->body = 'Still got time to claim your PA Insurance. Claim now! 😉';
                break;
            case 3:
                $notification->body = 'Don\'t wait too long, claim your FREE PA Insurance now! 🎁🎉';
                break;
            case 4:
                $notification->body = 'Still got time to claim your PA Insurance. Claim now! 😉';
                break;
            case 5:
                $notification->body = 'Don\'t wait too long, claim your FREE PA Insurance now! 🎁🎉';
                break;
            case 6:
                $notification->body = 'Don\'t miss out on your FREE PA Insurance. Claim NOW! 😉';
                break;
        }

        $notification->title = 'Your reward is expiring soon';

        return $notification;
    }

    /**
     * @return self
     */
    public static function toClaimEnd(): self
    {
        $notification = new self(__FUNCTION__);

        $notification->title = 'Your reward is expiring soon';
        $notification->body = 'You have not claimed your complimentary Personal Accident insurance. Tap here to claim.';

        return $notification;
    }

    /**
     * @return self
     */
    public static function toPolicyExpire(): self
    {
        $notification = new self(__FUNCTION__);

        $notification->title = 'PA policy expires today';
        $notification->body = 'Drive safe again this month to receive your next complimentary Personal Accident Insurance.';

        return $notification;
    }
}
