<?php namespace wcf\system\event\listener;

use wcf\acp\form\GiveUserAwardForm;
use wcf\data\acp\editlog\ACPEditLogHandler;
use wcf\data\award\issued\IssuedAwardAction;
use wcf\data\award\issued\IssuedAwardEditor;
use wcf\data\user\User;
use wcf\system\WCF;

class ACPEditAwardDeletedListener implements IParameterizedEventListener
{
    /**
     * Executes this action.
     *
     * @param	IssuedAwardAction $eventObj	Object firing the event
     * @param	string		$className	class name of $eventObj
     * @param	string		$eventName	name of the event fired
     * @param	array		&$parameters	given parameters
     */
    public function execute($eventObj, $className, $eventName, array &$parameters)
    {
        foreach ($eventObj->getObjects() as $awardEditor) {
            $award = $awardEditor->getDecoratedObject();

            $handler = ACPEditLogHandler::getInstance();
            $handler->log($award, WCF::getUser(), 'delete', [
                'title' => $award->getName(),
                'description' => $award->description,
                'date' => $award->date,
                'userID' => $award->userID,
                'username' => (new User($award->userID))->getUsername(),
            ]);
        }
    }
}