<?php

namespace App\Adapter\In\Api\Controller;

use App\Adapter\In\Api\Service\SerializerService;
use App\Application\Port\In\Booking\CreateBooking\CreateBookingCommand;
use App\Application\Port\In\Booking\CreateBooking\CreateBookingUseCase;
use App\Application\Port\In\Booking\CreateBookingOptions\CreateBookingOptionsCommand;
use App\Application\Port\In\Booking\CreateBookingOptions\CreateBookingOptionsUseCase;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{

    public function __construct(
        private SerializerService           $serializerService,
        private CreateBookingUseCase        $createBookingUseCase,
        private CreateBookingOptionsUseCase $createBookingOptionsUseCase
    )
    {
    }

    /**
     * @Route ("/booking-options", name="app_booking_options", methods={"POST"})
     */
    public function postBookingOptions(Request $request): Response
    {
        //TODO: check body and handle errors
        $from = new DateTimeImmutable($request->request->get('from'));
        $to = new DateTimeImmutable($request->request->get('to'));
        $response = $this->createBookingOptionsUseCase->handle(new CreateBookingOptionsCommand($from, $to));
        return new JsonResponse($this->serializerService->normalize($response->getCarBookingOptionsDto()), Response::HTTP_CREATED);
    }

    /**
     * @Route("/booking", name="app_booking", methods={"POST"})
     */
    public function postBooking(Request $request): Response
    {
        //TODO: check body and handle errors
        $from = new DateTimeImmutable($request->request->get('from'));
        $to = new DateTimeImmutable($request->request->get('to'));
        $response = $this->createBookingUseCase->handle(
            new CreateBookingCommand(
                $request->request->get('userId'),
                $request->request->get('brand'),
                $request->request->get('model'),
                $from,
                $to
            )
        );
        return new JsonResponse($this->serializerService->normalize($response), Response::HTTP_CREATED);
    }
}