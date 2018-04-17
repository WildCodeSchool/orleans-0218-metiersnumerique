<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 16/04/18
 * Time: 16:10
 */

namespace Model;


class Paginator
{
    /**
     * @var int
     */
    private $limit = LIMIT_PAGING_COMMENTS_ADMIN;
    /**
     * @var int
     */
    private $pageId;
    /**
     * @var int
     */
    private $nbElements;
    /**
     * @var AbstractManager
     */
    private $manager;

    public function __construct(AbstractManager $manager, int $pageId, int $nbElements)
    {
        $this->setPageId($pageId);
        $this->setNbElements($nbElements);
        $this->setManager($manager);
    }

    /**
     * @return AbstractManager
     */
    public function getManager(): AbstractManager
    {
        return $this->manager;
    }

    /**
     * @param AbstractManager $manager
     * @return Paginator
     */
    public function setManager(AbstractManager $manager): Paginator
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return Paginator
     */
    public function setLimit(int $limit): Paginator
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageId(): int
    {
        return $this->pageId;
    }

    /**
     * @param int $pageId
     * @return Paginator
     */
    public function setPageId(int $pageId): Paginator
    {
        $this->pageId = $pageId;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbElements(): int
    {
        return $this->nbElements;
    }

    /**
     * @param int $nbElements
     * @return Paginator
     */
    public function setNbElements(int $nbElements): Paginator
    {
        $this->nbElements = $nbElements;
        return $this;
    }


    /**
     * @return array
     */
    public function paginate(): array
    {
        $pattern = '/\D/';

        $nbPages = ceil($this->nbElements / $this->limit);

        if ($this->pageId > $nbPages) {
            $this->pageId = $nbPages;
        } elseif ($this->pageId < 1 || preg_match($pattern, $this->pageId)) {
            $this->pageId = 1;
        }

        $offset = $this->pageId * $this->limit - $this->limit;

        return $this->getManager()->select($this->limit, $offset);
    }
}