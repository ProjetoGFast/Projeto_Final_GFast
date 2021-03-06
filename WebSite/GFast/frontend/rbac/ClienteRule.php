<?php
namespace frontend\rbac;
use yii\rbac\Item;
use yii\rbac\Rule;
use common\models\Avaliacoes;

class ClienteRule extends Rule
{
    public $name = 'isCliente';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->ava_iduser == $user : false;
    }
}