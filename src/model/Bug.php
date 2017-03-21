<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="Model_BugRepository")
 *
 * @Table(name="bug")
 */
class Model_Bug
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
    private $description;

    /**
     * @Column(type="datetime")
     *
     * @var DateTime
     */
    private $created;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    private $status;

    /**
     * @ManyToOne(targetEntity="Model_User", inversedBy="reportedBugs")
     *
     * @var Model_User
     **/
    private $reporter;

    /**
     * @ManyToOne(targetEntity="Model_User", inversedBy="assignedBugs")
     *
     * @var Model_User
     **/
    private $engineer;

    /**
     * @ManyToMany(targetEntity="Model_Product")
     *
     * @var Model_Product[]|ArrayCollection
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Model_User $engineer
     */
    public function setEngineer($engineer)
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    /**
     * @param Model_User $reporter
     */
    public function setReporter($reporter)
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    /**
     * @return Model_User
     */
    public function getEngineer()
    {
        return $this->engineer;
    }

    /**
     * @return Model_User
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * @param Model_Product $product
     */
    public function assignToProduct($product)
    {
        $this->products[] = $product;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return void
     */
    public function close()
    {
        $this->status = "CLOSE";
    }

}