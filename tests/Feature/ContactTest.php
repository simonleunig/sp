<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\API\CallcenterController;
use App\Models\Callcenter;
use Illuminate\Http\Request;

class Contact_Test extends TestCase
{

    public function testCreateContact()
    {
        $requestdata = [
            'image' => 'https://www.muerwiker.de/typo3conf/ext/h2template/Resources/Public/Images/logomuerr.png',
            'assignment' => 'Arbeit',
            'city' => 'Niebüll',
            'street' => 'Chaussee 12',
            'number' => '12',
            'personone' => 'John Lo',
            'phoneone' => '121212',
            'emailone' => 'john@web.de',
            'persontwo' => 'Lennart Fe',
            'phonetwo' => '12314',
            'emailtwo' => 'LennartF@gmail.com',
            'emergency' => '110',
            'keywords' => 'Arbeit, Notfall'
        ];
    
        // Set up the request object
        $request = new \Illuminate\Http\Request($requestdata);
        $controller = new CallCenterController();
    
        // Call the create_contact method
        $response = $controller->create_contact($request);
    
        // Assert that the response is a JSON response
        $this->assertJson($response->getContent());
    
        // Assert that the callcenter was saved to the database
        $this->assertDatabaseHas('callcenters', $requestdata);
    }

               
    public function testUpdateContact()
    {

        $controller = new CallCenterController();
        
        $requestdata = [
            'image' => 'image.jpg',
            'assignment' => 'Wohnen',
            'city' => 'New York',
            'street' => 'Main St',
            'number' => '123',
            'personone' => 'John Doe',
            'phoneone' => '555-555-1212',
            'emailone' => 'johndoe@example.com',
            'persontwo' => 'Jane Doe',
            'phonetwo' => '555-555-1213',
            'emailtwo' => 'janedoe@example.com',
            'emergency' => '911',
            'keywords' => 'test'
        ];

        $request = new \Illuminate\Http\Request($requestdata);

        //Instanz erstellen und mit den Daten füllen
        //$controller = new CallCenterController();
        $response = $controller->create_contact($request);
        
        //Error: contact class missing
        //$contact = $response->getData()->contact;

        //updating data; ID has to be assigned
        $updatedcontact = [
            'id' => 1,
            'image' => 'image.jpg',
            'assignment' => 'Arbeit',
            'city' => 'Flensburg',
            'street' => 'Teststraße',
            'number' => '12',
            'personone' => 'Person 1',
            'phoneone' => '44544',
            'emailone' => 'person1@ex.com',
            'persontwo' => 'Person 2',
            'phonetwo' => '12345',
            'emailtwo' => 'person2@ex.com',
            'emergency' => '110',
            'keywords' => 'test, update',
        ];

        $updatedrequest = new \Illuminate\Http\Request($updatedcontact);

        //Update_Contact auf die Instanz ausführen
        $response = $controller->update_contact($updatedrequest);

        //weiß nicht ob man das tun muss
        $this->assertJson($response->getContent());

        
        //Kontrollieren ob der new Contact eingefügt wurde.
        $this->assertDatabaseHas('callcenters', $updatedcontact);

    }

    public function testDeleteContact()
    {
        $data = [
            'image' => 'https://www.muerwiker.de/typo3conf/ext/h2template/Resources/Public/Images/logomuerr.png',
            'assignment' => 'Arbeit',
            'city' => 'Niebüll',
            'street' => 'Chaussee 12',
            'number' => '12',
            'personone' => 'John Lo',
            'phoneone' => '121212',
            'emailone' => 'john@web.de',
            'persontwo' => 'Lennart Fe',
            'phonetwo' => '12314',
            'emailtwo' => 'LennartF@gmail.com',
            'emergency' => '110',
            'keywords' => 'Arbeit, Notfall'
        ];
    
        // request object + create method
        $request = new \Illuminate\Http\Request($data);
        $controller = new CallCenterController();

        $response = $controller->create_contact($request);

        // Get the ID of the created contact
        $contact = CallCenter::where('assignment', 'Arbeit')->first();
        $contactId = $contact->id;

        // delete request object + delete method
        $deleteRequest = new \Illuminate\Http\Request();
        $deleteRequest->replace(['id' => $contactId]);

        $response = $controller->delete_contact($deleteRequest);
        $this->assertEquals(200, $response->getStatusCode());

    }
    
}