<?php

namespace Telegram\Bot\Commands;
use TGKeyboard;
class ExpressionChooseFileCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "expression_choose_file";

    /**
     * @var string Command Description
     */
    protected $description = "File for expression";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $update = $this->getUpdate();

        $telegram_id = $update->getMessage()->chat->id;

        $result = user_is_verified($telegram_id);

        if(!$result['status']) {
            return false;
        }

/*        $options = [
            'chat_id' => $telegram_id,
        ];

        $options['text'] = __('Please provide a file (image/video/audio) or url of your creative expression:', $result['user']['language']);
        $this->telegram->sendMessage($options);*/
        if($result["expressions_in_proccess"]["type_enum"] === 'Text'){
            TGKeyboard::showMainKeyboard($telegram_id, $this->telegram, $result['user'],__('Please attach file of text CE', $result['user']['language']));

        }else{
            TGKeyboard::showMainKeyboard($telegram_id, $this->telegram, $result['user'],__('Please attach file of CE', $result['user']['language']));
        }

        set_command_to_last_message($this->name, $telegram_id);
    }
}