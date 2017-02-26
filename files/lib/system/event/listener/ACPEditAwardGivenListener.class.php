<?php namespace wcf\system\event\listener;

use wcf\acp\form\GiveUserAwardForm;
use wcf\data\acp\editlog\ACPEditLogHandler;
use wcf\data\user\User;
use wcf\system\WCF;

class ACPEditAwardGivenListener implements IParameterizedEventListener
{
    /**
     * Executes this action.
     *
     * @param	GiveUserAwardForm $eventObj	Object firing the event
     * @param	string		$className	class name of $eventObj
     * @param	string		$eventName	name of the event fired
     * @param	array		&$parameters	given parameters
     */
    public function execute($eventObj, $className, $eventName, array &$parameters)
    {
        $award = $eventObj->givenAward;

        $handler = ACPEditLogHandler::getInstance();
        $handler->log($award, WCF::getUser(), 'create', [
            'title' => $award->title,
            'description' => $award->description,
            'date' => $award->date,
            'userID' => $award->userID,
            'awardedNumber' => $award->awardedNumber,
            'username' => (new User($award->userID))->getUsername(),
        ]);
    }
}