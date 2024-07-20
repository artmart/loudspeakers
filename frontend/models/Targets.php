<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Targets".
 *
 * @property int $id
 * @property string $manufacturer
 * @property string $model
 * @property int $type
 * @property float $size
 * @property int $status
 * @property float $re
 * @property float $z1k
 * @property float $z10k
 * @property float $le
 * @property float $leb
 * @property float $ke
 * @property float $rss
 * @property float $fs
 * @property float $qms
 * @property float $qes
 * @property float $qts
 * @property float $rms
 * @property float $mms
 * @property float $cms
 * @property float $vas
 * @property float $sd
 * @property float $bl
 * @property float $pmax
 * @property float $xmax
 * @property float $beta
 * @property float $uspl
 * @property float $bl2_re
 * @property string $revision
 * @property string $updated
 * @property float $vocc
 * @property float $weight
 * @property float $diameter_oa
 * @property float $height_oa
 * @property string|null $target_curve
 * @property string|null $test_signal
 * @property float $cost
 * @property string $webpage
 * @property string $data_sheet
 * @property int $entered_by
 * @property string $entry_time
 *
 * @property User $enteredBy
 * @property Status $status0
 * @property Types $type0
 */
class Targets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'targets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target', 'entered_by', 'entry_time', 'updated'], 'required'],
            [['entered_by'], 'integer'],
            //[['size', 're', 'z1k', 'z10k', 'le', 'leb', 'ke', 'rss', 'fs', 'qms', 'qes', 'qts', 'rms', 'mms', 'cms', 'vas', 'sd', 'bl', 'pmax', 'xmax', 'beta', 'uspl', 'bl2_re', 'vocc', 'weight', 'diameter_oa', 'height_oa', 'cost'], 'number'],
            [['entry_time', 'updated'], 'safe'], //, 'target_curve_json'
            [['target'], 'string', 'max' => 500],
            //[['test_signal', 'target_curve', 'data_sheet'], 'string', 'max' => 255],
            //[['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status' => 'id']],
            //[['type'], 'exist', 'skipOnError' => true, 'targetClass' => Types::class, 'targetAttribute' => ['type' => 'id']],
            [['entered_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['entered_by' => 'id']],
            
            //[['test_signal'], 'file', 'skipOnEmpty' => true, 'extensions' => 'wav'],
            [['target_curve'], 'file', 'skipOnEmpty' => true, 'extensions' => 'csv'],
            //[['data_sheet'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [        
            'id' => 'ID',
            'target' => 'Target',
            /*'model' => 'Model',
            'type' => 'Type',
            'size' => 'Size [in]',
            'status' => 'Status',
            're' => 'Re [ohm]',
            'z1k' => 'Z1k [ohm]',
            'z10k' => 'Z10k [ohm]',
            'le' => 'Le [mH]',
            'leb' => 'Leb [mH]',
            'ke' => 'Ke [sH]',
            'rss' => 'Rss [ohm]',
            'fs' => 'fs [Hz]',
            'qms' => 'Qms',
            'qes' => 'Qes',
            'qts' => 'Qts',
            'rms' => 'Rms [Ns/m]',
            'mms' => 'Mms [g]',
            'cms' => 'Cms [mm/N]',
            'vas' => 'Vas [l]',
            'sd' => 'Sd [cm2]',
            'bl' => 'BL [Tm]',
            'pmax' => 'Pmax [W]',
            'xmax' => 'Xmax [mm]',
            'beta' => 'Beta',
            'uspl' => 'USPL [dB]',
            'bl2_re' => 'BL2/Re',
            'revision' => 'Revision',
            
            'vocc' => 'Vocc',
            'weight' => 'Weight',
            'diameter_oa' => 'Diameter_OA',
            'height_oa' => 'Height_OA',
            'target_curve' => 'Target Curve',
            'test_signal' => 'Test Signal',
            'cost' => 'Cost',
            'webpage' => 'Webpage',
            'data_sheet' => 'Data Sheet',*/
            'updated' => 'Updated',
            'entered_by' => 'Entered By',
            'entry_time' => 'Entry Time',
        ];
    }

    /**
     * Gets query for [[EnteredBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnteredBy()
    {
        return $this->hasOne(User::class, ['id' => 'entered_by']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Status::class, ['id' => 'status']);
    }

    /**
     * Gets query for [[Type0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(Types::class, ['id' => 'type']);
    }
}
