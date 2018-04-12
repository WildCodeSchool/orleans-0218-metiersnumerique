<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 10/04/18
 * Time: 17:39
 */

namespace Model;


class Comment
{
    private $id;
    private $firstname;
    private $lastname;
    private $date;
    private $email;
    private $wilder;
    private $avatar;
    private $profession;
    private $company;
    private $valid;
    private $like;
    private $question1;
    private $question2;
    private $question3;
    private $job_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    /**
     * @param mixed $firstname
     * @return Comment
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    /**
     * @param mixed $lastname
     * @return Comment
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @param mixed $date
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getWilder()
    {
        return $this->wilder;
    }
    /**
     * @param mixed $wilder
     * @return Comment
     */
    public function setWilder($wilder)
    {
        $this->wilder = $wilder;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    /**
     * @param mixed $avatar
     * @return Comment
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }
    /**
     * @param mixed $profession
     * @return Comment
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }
    /**
     * @param mixed $company
     * @return Comment
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }
    /**
     * @param mixed $valid
     * @return Comment
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLike()
    {
        return $this->like;
    }
    /**
     * @param mixed $like
     * @return Comment
     */
    public function setLike($like)
    {
        $this->like = $like;
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
     */
    public function setQuestion3($question3)
    {
        $this->question3 = $question3;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getJobId()
    {
        return $this->job_id;
    }
    /**
     * @param mixed $jobId
     * @return Comment
     */
    public function setJobId($jobId)
    {
        $this->job_id = $jobId;
        return $this;
    }

    public function hydrate(array $datas)
    {
        if (isset($datas['id'])) {
            $this->setId($datas['id']);
        }
        if (isset($datas['firstname'])) {
            $this->setFirstname($datas['firstname']);
        }
        if (isset($datas['lastname'])) {
            $this->setLastname($datas['lastname']);
        }
        if (isset($datas['date'])) {
            $this->setDate($datas['date']);
        }
        if (isset($datas['email'])) {
            $this->setEmail($datas['email']);
        }
        if (isset($datas['wilder'])) {
            $this->setWilder($datas['wilder']);
        }
        if (isset($datas['avatar'])) {
            $this->setAvatar($datas['avatar']);
        }
        if (isset($datas['profession'])) {
            $this->setProfession($datas['profession']);
        }
        if (isset($datas['company'])) {
            $this->setCompany($datas['company']);
        }
        if (isset($datas['valid'])) {
            $this->setValid($datas['valid']);
        }
        if (isset($datas['like'])) {
            $this->setLike($datas['like']);
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
        if (isset($datas['job_id'])) {
            $this->setJobId($datas['job_id']);
        }
    }
}
