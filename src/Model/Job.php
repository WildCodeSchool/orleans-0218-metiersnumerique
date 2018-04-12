<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 10:25
 */

namespace Model;


class Job
{
    private $id;
    private $name;
    private $resum;
    private $description;
    private $image;
    private $video;
    private $thumbnail;
    private $question1;
    private $question2;
    private $question3;
    private $themeId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Job
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Job
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResum()
    {
        return $this->resum;
    }

    /**
     * @param mixed $resum
     * @return Job
     */
    public function setResum($resum)
    {
        $this->resum = $resum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return Job
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return Job
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     * @return Job
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestion1()
    {
        return $this->question1;
    }

    /**
     * @param mixed $question1
     * @return Job
     */
    public function setQuestion1($question1)
    {
        $this->question1 = $question1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestion2()
    {
        return $this->question2;
    }

    /**
     * @param mixed $question2
     * @return Job
     */
    public function setQuestion2($question2)
    {
        $this->question2 = $question2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestion3()
    {
        return $this->question3;
    }

    /**
     * @param mixed $question3
     * @return Job
     */
    public function setQuestion3($question3)
    {
        $this->question3 = $question3;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThemeId()
    {
        return $this->themeId;
    }

    /**
     * @param mixed $themeId
     * @return Job
     */
    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;
        return $this;
    }
}
