<?php
namespace Blocks\FormMessage;

/**
 *  顯示 form message
 *  目前是輸出 twitter bootstrap 格式
 */
class Block extends \Blocks\BaseBlock
{

    public function toHtml()
    {
        $output = '';
        $resultMessages = FormMessageManager::getResultMessages();
        if( !$resultMessages ) {
            return;
        }
        FormMessageManager::clearResultMessages();

        foreach( $resultMessages as $messages ) {

            switch( $messages['type'] ) {
                case 'error':
                    $class = "alert-danger";
                    $alert = "Error";
                    break;
                case 'success':
                    $class = "alert-success";
                    $alert = "Success";
                    break;
                default:
                    // 未設定則輸出 info style
                    $class = "alert-info";
                    $alert = "Info";
            }

            if( isset($previousMessages) && $previousMessages['type']==$messages['type'] ) {
                $output .= '<div>'. $messages['message'] .'</div>';
            }
            else {
                if( $output ) {
                    $output .= '</div>';
                }
                $output .= '<div class="alert '. $class .'">'
                        .  '    <h4>'. $alert .'</h4>'
                        .  '    <div>'. $messages['message'] .'</div>';
            }

            $previousMessages = $messages;

        }

        $output .= '</div>';
        $this->value = $output;
    }

}