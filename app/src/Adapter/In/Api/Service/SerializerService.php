<?php

namespace App\Adapter\In\Api\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerService
{
    private Serializer $serializer;

    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $discriminator = new ClassDiscriminatorFromClassMetadata($classMetadataFactory);
        $encoders = [new JsonEncoder()];
        $objectNormalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null,
            null,
            null,
            $discriminator);
        $normalizers = [
            new DateTimeNormalizer([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d\\TH:i:s.v\\Z']),
            $objectNormalizer,
            new ArrayDenormalizer(),
        ];


        $this->serializer = new Serializer($normalizers, $encoders);
    }


    public function normalize($data, string $format = null, array $context = [])
    {
        try {
            return $this->serializer->normalize($data, $format, $context);
        } catch (Exception $e) {
            return null;
        }
    }

    public function denormalize($data, $type)
    {
        try {
            $dataDenormalized = $this->serializer->denormalize(
                $this->serializer->normalize($data),
                $type,
                null,
                [
                    ObjectNormalizer::ENABLE_MAX_DEPTH => true,
                    ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                        return $object->getId();
                    },
                ]
            );
            if ($dataDenormalized instanceof $type || is_array($dataDenormalized)) {
                return $dataDenormalized;
            } else {
                throw  new Exception('SERIALIZER ERROR', 500);
            }
        } catch (Exception $e) {
            throw  new Exception($e->getMessage(), 500);
        }
    }

}