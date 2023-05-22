<?php

declare(strict_types=1);

namespace Crm\Project\Events;

//use App\Events\Illuminate;
use Crm\Project\Models\Project;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectCreation
{
    use Dispatchable;
    use SerializesModels;
    use InteractsWithSockets;

    /**
     * @var Project
     */
    private Project $project;

    /**
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->setProject($project);
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
