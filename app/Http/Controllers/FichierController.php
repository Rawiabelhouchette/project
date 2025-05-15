<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FichierController extends Controller
{
    public function getImage()
    {
        $imageUrl = request()->query('path');    // ex: 'photos/image.jpg'
        $width = request()->query('width');      // ex: 300
        $height = request()->query('height');    // ex: 200

        $chemin = storage_path("app/public/{$imageUrl}");

        if (!file_exists($chemin)) {
            abort(404);
        }

        // Obtenir type MIME
        $mime = mime_content_type($chemin);

        // Charger image selon le type
        // switch ($mime) {
        //     case 'image/jpeg':
        //         $srcImage = imagecreatefromjpeg($chemin);
        //         break;
        //     case 'image/png':
        //         $srcImage = imagecreatefrompng($chemin);
        //         break;
        //     case 'image/gif':
        //         $srcImage = imagecreatefromgif($chemin);
        //         break;
        //     default:
        //         abort(415, 'Unsupported image type.');
        // }
        switch ($mime) {
            case 'image/jpeg':
                $srcImage = imagecreatefromjpeg($chemin);
                break;
            case 'image/png':
                $srcImage = imagecreatefrompng($chemin);
                break;
            case 'image/gif':
                $srcImage = imagecreatefromgif($chemin);
                break;
            case 'image/heic':
                $imagick = new Imagick($chemin);
                $imagick->setImageFormat('jpeg');  // Convertit HEIC en JPEG
                $srcImage = imagecreatefromstring($imagick->getImageBlob());
                break;
            default:
                abort(415, 'Unsupported image type.');
        }


        list($origWidth, $origHeight) = getimagesize($chemin);

        // Si pas de dimensions, on garde l'original
        $newWidth = $width ?? $origWidth;
        $newHeight = $height ?? $origHeight;

        // Créer nouvelle image
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        // Gestion de transparence pour PNG & GIF
        if ($mime === 'image/png' || $mime === 'image/gif') {
            imagecolortransparent($resizedImage, imagecolorallocatealpha($resizedImage, 0, 0, 0, 127));
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
        }

        // Redimensionner
        imagecopyresampled(
            $resizedImage,
            $srcImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        // Capture l'image dans un buffer mémoire
        ob_start();
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($resizedImage, null, 90);
                break;
            case 'image/png':
                imagepng($resizedImage);
                break;
            case 'image/gif':
                imagegif($resizedImage);
                break;
        }
        $imageData = ob_get_clean();

        // Libération mémoire
        imagedestroy($srcImage);
        imagedestroy($resizedImage);

        return Response::make($imageData, 200, [
            'Content-Type' => $mime,
        ]);
    }

    public function getResizedImage()
    {}
}
