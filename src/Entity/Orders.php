<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;
/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="payment_mode", columns={"payment_mode"}), @ORM\Index(name="registeredBy", columns={"registeredBy"}), @ORM\Index(name="pricing", columns={"pricing"}), @ORM\Index(name="payment_status", columns={"payment_status"}), @ORM\Index(name="item_status", columns={"item_status"})})
 * @ORM\Entity
 *
 *   @NamedQueries({
 *     @NamedQuery(name="dailyOrders", query="SELECT DISTINCT o FROM App\Entity\Orders o WHERE o.orderDate = :orderDate"),
 *      @NamedQuery(name="dateRangeOrdersByBranch", query="SELECT DISTINCT o FROM App\Entity\Orders o WHERE o.orderDate >= :startDate AND o.orderDate <= :endDate AND o.branch= :branchId"),
 *     @NamedQuery(name="customerHistoryByBranch", query="SELECT DISTINCT o FROM App\Entity\Orders o WHERE o.registeredby = :userId AND o.branch= :branchId group by o.ordercode"),
 *     @NamedQuery(name="orderByCode", query="SELECT DISTINCT o FROM App\Entity\Orders o WHERE o.ordercode = :orderCode")
 * })
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ordercode", type="string", length=250, nullable=true)
     */
    private $ordercode;

    /**
     * @var string
     *
     * @ORM\Column(name="item_sell_price", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $itemSellPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="vat", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $vat;

    /**
     * @var int
     *
     * @ORM\Column(name="order_quantity", type="integer", nullable=false)
     */
    private $orderQuantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="date", nullable=false)
     */
    private $orderDate;

    /**
     * @var string
     *
     * @ORM\Column(name="order_Et_Date", type="string", length=250, nullable=false)
     */
    private $orderEtDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_time", type="time", nullable=false)
     */
    private $orderTime;

    /**
     * @var \Pricing
     *
     * @ORM\ManyToOne(targetEntity="Pricing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pricing", referencedColumnName="id")
     * })
     */
    private $pricing;

    /**
     * @var \Paymentmode
     *
     * @ORM\ManyToOne(targetEntity="Paymentmode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_mode", referencedColumnName="id")
     * })
     */
    private $paymentMode;

    /**
     * @var \Paymentstatus
     *
     * @ORM\ManyToOne(targetEntity="Paymentstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_status", referencedColumnName="id")
     * })
     */
    private $paymentStatus;

    /**
     * @var \Stockuser
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registeredBy", referencedColumnName="id")
     * })
     */
    private $registeredby;

    /**
     * @var \Itemstatus
     *
     * @ORM\ManyToOne(targetEntity="Itemstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_status", referencedColumnName="id")
     * })
     */
    private $itemStatus;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status", referencedColumnName="id")
     * })
     */
    private $status;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch", referencedColumnName="id")
     * })
     */
    private $branch;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdercode(): ?string
    {
        return $this->ordercode;
    }

    public function setOrdercode(?string $ordercode): self
    {
        $this->ordercode = $ordercode;

        return $this;
    }

    public function getItemSellPrice()
    {
        return $this->itemSellPrice;
    }

    public function setItemSellPrice($itemSellPrice): self
    {
        $this->itemSellPrice = $itemSellPrice;

        return $this;
    }

    public function getVat()
    {
        return $this->vat;
    }

    public function setVat($vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getOrderQuantity(): ?int
    {
        return $this->orderQuantity;
    }

    public function setOrderQuantity(int $orderQuantity): self
    {
        $this->orderQuantity = $orderQuantity;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getOrderEtDate(): ?string
    {
        return $this->orderEtDate;
    }

    public function setOrderEtDate(string $orderEtDate): self
    {
        $this->orderEtDate = $orderEtDate;

        return $this;
    }

    public function getOrderTime(): ?\DateTimeInterface
    {
        return $this->orderTime;
    }

    public function setOrderTime(\DateTimeInterface $orderTime): self
    {
        $this->orderTime = $orderTime;

        return $this;
    }

    public function getPricing(): ?Pricing
    {
        return $this->pricing;
    }

    public function setPricing(?Pricing $pricing): self
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function getPaymentMode(): ?Paymentmode
    {
        return $this->paymentMode;
    }

    public function setPaymentMode(?Paymentmode $paymentMode): self
    {
        $this->paymentMode = $paymentMode;

        return $this;
    }

    public function getPaymentStatus(): ?Paymentstatus
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(?Paymentstatus $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getRegisteredby(): ?User
    {
        return $this->registeredby;
    }

    public function setRegisteredby(?User $registeredby): self
    {
        $this->registeredby = $registeredby;

        return $this;
    }

    public function getItemStatus(): ?Itemstatus
    {
        return $this->itemStatus;
    }

    public function setItemStatus(?Itemstatus $itemStatus): self
    {
        $this->itemStatus = $itemStatus;

        return $this;
    }
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): self
    {
        $this->branch = $branch;

        return $this;
    }


}
