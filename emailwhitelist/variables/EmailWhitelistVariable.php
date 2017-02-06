<?php
namespace Craft;

class EmailWhitelistVariable
{
    public function getEmails()
		{
				return craft()->emailWhitelist_getEmails->getEmails();
		}
}