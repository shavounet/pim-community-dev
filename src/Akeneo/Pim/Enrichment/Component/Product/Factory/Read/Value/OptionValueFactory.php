<?php
declare(strict_types=1);

namespace Akeneo\Pim\Enrichment\Component\Product\Factory\Read\Value;

use Akeneo\Pim\Enrichment\Component\Product\Model\ValueInterface;
use Akeneo\Pim\Enrichment\Component\Product\Value\OptionValue;
use Akeneo\Pim\Structure\Component\AttributeTypes;
use Akeneo\Pim\Structure\Component\Query\PublicApi\AttributeType\Attribute;

/**
 * @author    Anael Chardan <anael.chardan@akeneo.com>
 * @copyright 2019 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
final class OptionValueFactory implements ReadValueFactory
{
    public function create(Attribute $attribute, ?string $channelCode, ?string $localeCode, $data): ValueInterface
    {
        $attributeCode = $attribute->code();

        if ($attribute->isLocalizableAndScopable()) {
            return OptionValue::scopableLocalizableValue($attributeCode, $data, $channelCode, $localeCode);
        }

        if ($attribute->isScopable()) {
            return OptionValue::scopableValue($attributeCode, $data, $channelCode);
        }

        if ($attribute->isLocalizable()) {
            return OptionValue::localizableValue($attributeCode, $data, $localeCode);
        }

        return OptionValue::value($attributeCode, $data);
    }

    public function supportedAttributeType(): string
    {
        return AttributeTypes::OPTION_SIMPLE_SELECT;
    }
}
