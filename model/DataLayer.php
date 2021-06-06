<?php

class DataLayer
{
    // personal-info page
    function getGender()
    {
        return array('Male', 'Female', 'Non-Binary', 'Other');
    }

    // profile page
    function getSeeking()
    {
        return array('Male', 'Female', 'Non-Binary', 'Other');

    }

    // indoor interests
    function getIndoor()
    {
        return array("Meditating", "Movies/TV", "Cooking", "Board Games", "Puzzles", "Reading",
            "Playing Cards", "Dancing");
    }

    function getOutdoor()
    {
        return array("Hiking", "Biking", "Swimming", "Running", "Sports", "Foraging",
            "Climbing", "Gardening");

    }

}

