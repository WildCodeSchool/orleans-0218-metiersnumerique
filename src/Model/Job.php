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
        return $this->theme_id;
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
