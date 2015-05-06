<?php
namespace T4webEmployees\View\Helper;

use DateTime;
use DateInterval;
use Zend\View\Model\ViewModel;

class EmployeesYearPaginatorViewModel extends ViewModel
{

    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);

        $this->template = "t4web-employees/helper/year-paginator";
    }

    /**
     * @var DateTime
     */
    private $startDate;

    /**
     * @var DateTime
     */
    private $current;

    /**
     * @return DateTime
     */
    public function getNext()
    {
        return $this->startDate->add(new DateInterval("P1Y"));
    }

    /**
     * @param DateTime $current
     */
    public function setCurrent($current)
    {
        $this->current = $current;
        $this->startDate = clone $current;
        $this->startDate->sub(new DateInterval('P3Y'));
    }

    public function isCurrent()
    {
        return $this->startDate == $this->current;
    }

    public function getNextPage()
    {
        $current = clone $this->current;

        return $current->modify('+1 year');
    }

    public function getPrevPage()
    {
        $current = clone $this->current;

        return $current->modify('-1 year');
    }

}
