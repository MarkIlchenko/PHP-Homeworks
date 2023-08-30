<?php

interface MoneyManagement
{
    public function deposit($amount);
    public function withdraw($amount);
}