<?php
namespace App\Services;

use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;
use PDF;

class ReportService {

    protected $userRepository;
    protected $tweetRepository;

    public function __construct(UserRepository $userRepository, TweetRepository $tweetRepository)
    {
        $this->userRepository = $userRepository;
        $this->tweetRepository = $tweetRepository;
    }


    public function downloadPdf()
    {

        $pdfInfo = $this->pdfInfo();

        $pdfReport =  $this->generatePdf($pdfInfo);

        return $pdfReport->download();
    }

    private function pdfInfo()
    {

        return  [
            'usersWithCountedTweets' => $this->userRepository->usersWithCountedTweets(),
            'totalUsers' => $this->userRepository->totalUsers(),
            'totalTweets' => $this->tweetRepository->totalTweets()
        ];
    }

    private function generatePdf($data)
    {

        return PDF::loadView('reports.pdf-report', $data);
    }
}
