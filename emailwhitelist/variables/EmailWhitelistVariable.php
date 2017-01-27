<?php
namespace Craft;

class EmailWhitelistVariable
{
    public function getAllowedEmails()
		{
				return craft()->EmailWhitelist_getAllowedEmails->getAllowedEmails();
		}
}