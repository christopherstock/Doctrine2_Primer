<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 *
 * @Table(name="user")
 */
class Model_User
{

    /**
     * @Id @GeneratedValue @Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="Model_Bug", mappedBy="reporter")
     *
     * @var Model_Bug[]
     */
    protected $reportedBugs;

    /**
     * @OneToMany(targetEntity="Model_Bug", mappedBy="engineer")
     *
     * @var ArrayCollection
     */
    protected $assignedBugs;

    public function __construct()
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Model_Bug $bug
     */
    public function addReportedBug($bug)
    {
        $this->reportedBugs[] = $bug;
    }

    /**
     * @param Model_Bug $bug
     */
    public function assignedToBug($bug)
    {
        $this->assignedBugs[] = $bug;
    }

}