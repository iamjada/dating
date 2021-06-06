<!-- 328/dating/classes/PremiumMember.php-->
<?php

class PremiumMember extends Member
{
    // fields
    private $_inDoorInterests;
    private $_outDoorInterests;



    // getter and setter
    /**
     * @return String of Premium Member's indoor interests
     */
    public function getInDoorInterests() : string
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param String $inDoorInterests
     */
    public function setInDoorInterests(string $inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return String of Premium Member's outdoor interest
     */
    public function getOutDoorInterests() : string
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param String $outDoorInterests
     */
    public function setOutDoorInterests(string $outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }


}