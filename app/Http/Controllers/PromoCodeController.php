<?php

namespace App\Http\Controllers;

use app\Exceptions\AppException;
use App\Http\Request;
use App\Http\Response;
use App\Services\PromoCode;
use App\Services\User;

class PromoCodeController extends Controller
{
    public function getUserCode(Request $request): Response
    {
        $promoCodeService = new PromoCode;

        if (!$userId = $request->cookie('user_id')) {
            $userService = new User;
            $userId = $userService->register();
        }

        try {
            $code = $promoCodeService->getCodeForUser($userId);
        } catch (AppException $e) {
            return $this->error($e->getMessage());
        }

        return $this->redirect($this->getPartnerLink($code))->withCookie([
            'user_id' => $userId,
        ]);
    }

    private function getPartnerLink(string $code): string
    {
        $partnerLink = $this->app->config['app']['partner']['link'];
        $partnerLink .= '?'.$this->app->config['app']['partner']['param'].'='.$code;

        return $partnerLink;
    }
}
