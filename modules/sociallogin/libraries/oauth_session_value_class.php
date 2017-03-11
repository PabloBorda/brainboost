<?php
/*
 * oauth_client.php
 *
 * @(#) $Id: oauth_client.php,v 1.145 2016/02/04 03:21:17 mlemos Exp $
 *
 */

class oauth_session_value_class
{
    public $id;
    public $session;
    public $state;
    public $access_token;
    public $access_token_secret;
    public $authorized;
    public $expiry;
    public $type;
    public $server;
    public $creation;
    public $refresh_token;
    public $access_token_response;
};