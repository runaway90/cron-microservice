<?php

namespace TestApp\Domain\Anime;

use TestApp\Domain\Anime\Description\Content;
use TestApp\Domain\Anime\Description\Status;
use TestApp\Domain\Anime\Description\Type;

class Description
{
    /** @var Type */
    private $type;

    /** @var Status */
    private $status;

    /** @var Content */
    private $content;

    public function __construct(Type $type = null, Status $status = null, Content $content = null)
    {
        $this->type = $type;
        $this->status = $status;
        $this->content = $content;
    }

    /**
     * @return Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }
}
