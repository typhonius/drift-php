<?php

namespace Drift\Models;

class MeetingModel extends BaseModel implements BaseModelInterface
{

    public $agentId;
    public $orgId;
    public $status;
    public $meetingSource;
    public $schedulerId;
    public $eventId;
    public $slug;
    public $slotStart;
    public $slotEnd;
    public $updatedAt;
    public $scheduledAt;
    public $meetingType;
    public $conversationId;
    public $endUserTimeZone;
    public $meetingNotes;
    public $bookedBy;

    public function __construct($meeting)
    {
        $this->agentId = $meeting->agentId;
        $this->orgId = $meeting->orgId;
        $this->status = $meeting->status;
        $this->meetingSource = $meeting->meetingSource;
        $this->schedulerId = $meeting->schedulerId;
        $this->eventId = $meeting->eventId;
        $this->slug = $meeting->slug;
        $this->slotStart = $meeting->slotStart;
        $this->slotEnd = $meeting->slotEnd;
        $this->updatedAt = $meeting->updatedAt;
        $this->scheduledAt = $meeting->scheduledAt;
        $this->meetingType = $meeting->meetingType;
        $this->conversationId = $meeting->conversationId;
        $this->endUserTimeZone = $meeting->endUserTimeZone;
        $this->meetingNotes = $meeting->meetingNotes;
        $this->bookedBy = $meeting->bookedBy;
    }
}
