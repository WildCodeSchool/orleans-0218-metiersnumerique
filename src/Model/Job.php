<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 11/04/18
 * Time: 19:53
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
    private $theme_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
     */
    public function setName($name): void
    {
        $this->name = $name;
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
     */
    public function setResum($resum): void
    {
        $this->resum = $resum;
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
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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
     */
    public function setImage($image): void
    {
        $this->image = $image;
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
     */
    public function setVideo($video): void
    {
        $this->video = $video;
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
     */
    public function setThumbnail($thumbnail): void
    {
        $this->thumbnail = $thumbnail;
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
     */
    public function setQuestion1($question1): void
    {
        $this->question1 = $question1;
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
     */
    public function setQuestion2($question2): void
    {
        $this->question2 = $question2;
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
     */
    public function setQuestion3($question3): void
    {
        $this->question3 = $question3;
    }

    /**
     * @return mixed
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }

    /**
     * @param mixed $theme_id
     */
    public function setThemeId($theme_id): void
    {
        $this->theme_id = $theme_id;
    }

    public function hydrate(array $datas)
    {
        if (isset($datas['id'])) {
            $this->setId($datas['id']);
        }
        if (isset($datas['name'])) {
            $this->setName($datas['name']);
        }
        if (isset($datas['resum'])) {
            $this->setResum($datas['resum']);
        }
        if (isset($datas['description'])) {
            $this->setDescription($datas['description']);
        }
        if (isset($datas['image'])) {
            $this->setImage($datas['image']);
        }
        if (isset($datas['video'])) {
            $this->setVideo($datas['video']);
        }
        if (isset($datas['thumbnail'])) {
            $this->setThumbnail($datas['thumbnail']);
        }
        if (isset($datas['question1'])) {
            $this->setQuestion1($datas['question1']);
        }
        if (isset($datas['question2'])) {
            $this->setQuestion2($datas['question2']);
        }
        if (isset($datas['question3'])) {
            $this->setQuestion3($datas['question3']);
        }
        if (isset($datas['theme_id'])) {
            $this->setThemeId($datas['theme_id']);
        }
    }
}