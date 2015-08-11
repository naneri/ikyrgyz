<?php 

class SkillService{


    public static function countDeltaComment($skill){

        $iMinSize = 0.004;
        $iMaxSize = 0.5;
        $iSizeRange = $iMaxSize - $iMinSize;
        $iMinCount = log(0 + 1);
        $iMaxCount = log(500 + 1);
        $iCountRange = $iMaxCount - $iMinCount;
        if ($iCountRange == 0) {
            $iCountRange = 1;
        }
        if ($skill > 50 and $skill < 200) {
            $skill_new = $skill / 70;
        } elseif ($skill >= 200) {
            $skill_new = $skill / 10;
        } else {
            $skill_new = $skill / 130;
        }
        $iDelta = $iMinSize + (log($skill_new + 1) - $iMinCount) * ($iSizeRange / $iCountRange);

        return $iDelta;
    }

    public static function countDeltaTopic($skill){
        
        $iMinSize = 0.1;
        $iMaxSize = 8;
        $iSizeRange = $iMaxSize - $iMinSize;
        $iMinCount = log(0 + 1);
        $iMaxCount = log(500 + 1);
        $iCountRange = $iMaxCount - $iMinCount;
        if ($iCountRange == 0) {
            $iCountRange = 1;
        }
        if ($skill > 50 and $skill < 200) {
            $skill_new = $skill / 70;
        } elseif ($skill >= 200) {
            $skill_new = $skill / 10;
        } else {
            $skill_new = $skill / 100;
        }

        $iDelta = $iMinSize + (log($skill_new + 1) - $iMinCount) * ($iSizeRange / $iCountRange);

        return $iDelta;
    }
}