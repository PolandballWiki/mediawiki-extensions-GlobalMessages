<?php
namespace MediaWiki\Extension\GlobalMessages\Hooks;

use MediaWiki\Extension\GlobalMessages\GlobalMessageRegistry;

// @phpcs:disable MediaWiki.NamingConventions.LowerCamelFunctionsName.FunctionName

final class NamespaceHooks implements
    \MediaWiki\Cache\Hook\MessagesPreLoadHook
{
    /** @var GlobalMessageRegistry */
    private GlobalMessageRegistry $registry;

    /**
     * @param GlobalMessageRegistry $mainConfig
     */
    public function __construct( GlobalMessageRegistry $registry ) {
        $this->registry = $registry;
    }

	/**
	 * This hook is called when loading a message from the database.
	 *
	 * @since 1.35
	 *
	 * @param string $title Title of the message
	 * @param string &$message Message you want to define
	 * @param string $code Language code
	 * @return bool|void True or no return value to continue or false to abort
	 */
	public function onMessagesPreLoad( $title, &$message, $code ) {
        $result = $this->registry->resolve( $title, $code );
        if ( $result !== null ) {
            $message = $result;
        }
    }
}
