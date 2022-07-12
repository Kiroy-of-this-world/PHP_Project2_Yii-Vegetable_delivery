<?php

use yii\db\Migration;
use common\models\User;

/**
 * Class m220510_171531_create_rbac_data
 */
class m220510_171531_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $orderStatusChangeOnlyPermission = $auth->createPermission('orderStatusChangeOnly');
        $auth->add($orderStatusChangeOnlyPermission);

        $fullWorkWithProductsPermission = $auth->createPermission('fullWorkWithProducts');
        $auth->add($fullWorkWithProductsPermission);

        $fullWorkWithOrdersPermission = $auth->createPermission('fullWorkWithOrders');
        $auth->add($fullWorkWithOrdersPermission);


        $managerRole = $auth->createRole('manager');
        $auth->add($managerRole);

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);


        $auth->addChild($managerRole, $orderStatusChangeOnlyPermission);
        $auth->addChild($managerRole, $fullWorkWithProductsPermission);

        $auth->addChild($adminRole, $managerRole);
        $auth->addChild($adminRole, $fullWorkWithOrdersPermission);


        $user = new User([
            'email' => 'admin@admin.com',
            'username' => 'Admin',
            'password_hash' => '$2y$13$Y5E3E8p4frHOQBHu/e43vObqDY8m8xcDMcf2/tS4KxH9QjOqHI4ui',
        ]);
        $user->generateAuthKey();
        $user->save();


        $auth->assign($adminRole, $user->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220510_171531_create_rbac_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220510_171531_create_rbac_data cannot be reverted.\n";

        return false;
    }
    */
}
