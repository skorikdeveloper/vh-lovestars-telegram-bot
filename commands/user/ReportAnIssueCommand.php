<?php

namespace Telegram\Bot\Commands;


/**
 * Class MyConnectionsCommand.
 */
class ReportAnIssueCommand extends Command
{
	/**
	 * @var string Command Name
	 */
	protected $name = "report_an_issue";
	
	/**
	 * @var string Command Description
	 */
	protected $description = "Report an issue";
	
	/**
	 * {@inheritdoc}
	 */

    public function handle()
    {
        $update = $this->getUpdate();
        $telegram_id = $update->getMessage()->chat->id;

        $user = user_is_verified($telegram_id);

        if(!$user['status']) {
            return false;
        }

        $options = [
            'chat_id' => $telegram_id,
        ];

        $options['text'] = __('If you ever run into a hiccup with our chatbot', $user['user']['language']);
        $this->telegram->sendMessage($options);
        set_command_to_last_message($this->name, $telegram_id);
    }
}
