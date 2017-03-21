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
     * @Id @Column(type="integer") @GeneratedValue
     *
     * @var int
     */
    private $id;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    private $name;

    /**
     * @OneToMany(targetEntity="Model_Bug", mappedBy="reporter")
     *
     * @var Model_Bug[]|ArrayCollection
     */
    private $reportedBugs;

    /**
     * @OneToMany(targetEntity="Model_Bug", mappedBy="engineer")
     *
     * @var Model_Bug[]|ArrayCollection
     */
    private $assignedBugs;

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