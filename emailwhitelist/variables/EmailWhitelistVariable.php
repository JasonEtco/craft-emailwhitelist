<?php
namespace Craft;

class EmailWhitelistVariable
{
    public function getAllowedEmails()
		{
				return craft()->emailWhitelist_getAllowedEmails->getAllowedEmails();
		}
}