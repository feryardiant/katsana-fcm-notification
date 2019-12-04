<?php

namespace NotificationChannels\Fcm\Notifications;

use NotificationChannels\Fcm\Message;

class TripSummary extends Notification
{
    /**
     * Get the trip summary representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \NotificationChannels\Fcm\Message
     */
    public function toFcm($notifiable)
    {
        $data = [
            'pushType' => 'sync',
            'key' => 'trip-summary',
            'distance' => $notifiable->summary->distance,
            'duration' => $notifiable->summary->distance,
            'start_time' => $notifiable->summary->distance,
            'start_latitude' => $notifiable->summary->distance,
            'start_longitude' => $notifiable->summary->distance,
            'end_time' => $notifiable->summary->distance,
            'end_latitude' => $notifiable->summary->distance,
            'end_longitude' => $notifiable->summary->distance,
            'vehicle_id' => $notifiable->summary->vehicleId,
        ];

        return (new Message)
                    ->topic('notify-user-trip-summary')
                    ->data($data);
    }
}
