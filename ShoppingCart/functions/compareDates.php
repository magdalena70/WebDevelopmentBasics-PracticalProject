<?php
function checkStartPromotion($datePromotion, $currentDate){
    $datePromotionStr = (string)$datePromotion;
    $currentDateStr = (string)$currentDate;

    $datePromotionExplode =  explode("-", $datePromotionStr);
    $datePromotionYear = intval($datePromotionExplode[0]);
    $datePromotionMonth = intval($datePromotionExplode[1]);
    $datePromotionDay = intval($datePromotionExplode[2]);

    $currentDateExplode =  explode("-", $currentDateStr);
    $currentDateYear = intval($currentDateExplode[0]);
    $currentDateMonth = intval($currentDateExplode[1]);
    $currentDateDay = intval($currentDateExplode[2]);

    if($datePromotionYear > $currentDateYear){
        return false;
    }

    if($datePromotionYear < $currentDateYear){
        return true;
    }

    if($datePromotionYear == $currentDateYear) {
        if ($datePromotionMonth > $currentDateMonth) {
            return false;
        }

        if ($datePromotionMonth < $currentDateMonth) {
            return true;
        }

        if($datePromotionMonth == $currentDateMonth) {
            if($datePromotionDay > $currentDateDay){
                return false;
            }else{
                return true;
            }
        }
    }
}

function checkEndPromotion($datePromotion, $currentDate){
    $datePromotionStr = (string)$datePromotion;
    $currentDateStr = (string)$currentDate;

    $datePromotionExplode =  explode("-", $datePromotionStr);
    $datePromotionYear = intval($datePromotionExplode[0]);
    $datePromotionMonth = intval($datePromotionExplode[1]);
    $datePromotionDay = intval($datePromotionExplode[2]);

    $currentDateExplode =  explode("-", $currentDateStr);
    $currentDateYear = intval($currentDateExplode[0]);
    $currentDateMonth = intval($currentDateExplode[1]);
    $currentDateDay = intval($currentDateExplode[2]);

    if($datePromotionYear < $currentDateYear){
        return false;
    }

    if($datePromotionYear > $currentDateYear){
        return true;
    }

    if($datePromotionYear == $currentDateYear) {
        if ($datePromotionMonth < $currentDateMonth) {
            return false;
        }

        if ($datePromotionMonth > $currentDateMonth) {
            return true;
        }

        if($datePromotionMonth == $currentDateMonth) {
            if($datePromotionDay < $currentDateDay){
                return false;
            }else{
                return true;
            }
        }
    }
}

function checkCurrentPromotion($isValidStart, $isValidEnd){

    if($isValidStart && $isValidEnd) {
            return true;

    }else {
        return false;
    }
}