<?php

class Member
{
  // -------------------------fields
  public $emailID;
  public $name;
  public $borrowingDuration;
  public $timeJoined;
  public $booksReserved;
  public $booksBorrowed;
  public $borrowingHistory;
  public $borrowingRecord;
  public $mode;
  public $borrowCap;
  public $notifications;

  function __constructor($name, $emailID, $mode, $borrowingDuration, $timeJoined)
  {
    $this->name = $name;
    $this->emailID = $emailID;
    $this->borrowingDuration = $borrowingDuration;
    $this->mode = $mode;
    $this->timeJoined = $timeJoined;
  }




  // public function getName()
  // {
  //   return $this->name;
  // }

  // public function setName($name)
  // {
  //   $this->name = $name;
  // }

  // public function getEmailID()
  // {
  //   return $this->emailID;
  // }

  // public function setEmailID($emailID)
  // {
  //   $this->emailID = $emailID;
  // }


  // public function setBorrowingDuration($borrowingDuration)
  // {
  //   $this->borrowingDuration = $borrowingDuration;
  // }

  // public function getTimeJoined()
  // {
  //   return $this->timeJoined;
  // }



  // public function getBooksBorrowed()
  // {
  //   return $this->booksBorrowed;
  // }


  // public function getBorrowingHistory()
  // {
  //   return $this->borrowingHistory;
  // }


  // public function getBorrowingRecord()
  // {
  //   return $this->borrowingRecord;
  // }

  // public function setBorrowingRecord($borrowingRecord)
  // {
  //   $this->borrowingRecord = $borrowingRecord;
  // }

  // public function setMode($mode)
  // {
  //   $this->mode = $mode;
  // }


  // public function setBorrowCap($borrowCap)
  // {
  //   $this->borrowCap = $borrowCap;
  // }

  // public function getNotifications()
  // {
  //   return $this->notifications;
  // }
}
