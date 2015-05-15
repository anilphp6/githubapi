<?php

/**
 * API common methods for GIT/BITBUCKET
 */
interface Commands {

    /**
     * Get single/all contributer(s) commit count on a particular git/bitbucket repository
     * 
     */
    public function getCommitCount();
    
}
