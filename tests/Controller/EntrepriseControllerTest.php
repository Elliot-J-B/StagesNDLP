<?php

namespace App\Tests\Controller;

use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EntrepriseControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;

    /** @var EntityRepository<Entreprise> */
    private EntityRepository $entrepriseRepository;
    private string $path = '/entreprise/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->entrepriseRepository = $this->manager->getRepository(Entreprise::class);

        foreach ($this->entrepriseRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entreprise index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'entreprise[nom]' => 'Testing',
            'entreprise[email]' => 'Testing',
            'entreprise[image]' => 'Testing',
            'entreprise[numero]' => 'Testing',
            'entreprise[descriptif]' => 'Testing',
            'entreprise[localisation]' => 'Testing',
        ]);

        self::assertResponseRedirects('/entreprise');

        self::assertSame(1, $this->entrepriseRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Entreprise();
        $fixture->setNom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setImage('My Title');
        $fixture->setNumero('My Title');
        $fixture->setDescriptif('My Title');
        $fixture->setLocalisation('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entreprise');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Entreprise();
        $fixture->setNom('Value');
        $fixture->setEmail('Value');
        $fixture->setImage('Value');
        $fixture->setNumero('Value');
        $fixture->setDescriptif('Value');
        $fixture->setLocalisation('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'entreprise[nom]' => 'Something New',
            'entreprise[email]' => 'Something New',
            'entreprise[image]' => 'Something New',
            'entreprise[numero]' => 'Something New',
            'entreprise[descriptif]' => 'Something New',
            'entreprise[localisation]' => 'Something New',
        ]);

        self::assertResponseRedirects('/entreprise');

        $fixture = $this->entrepriseRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getNumero());
        self::assertSame('Something New', $fixture[0]->getDescriptif());
        self::assertSame('Something New', $fixture[0]->getLocalisation());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Entreprise();
        $fixture->setNom('Value');
        $fixture->setEmail('Value');
        $fixture->setImage('Value');
        $fixture->setNumero('Value');
        $fixture->setDescriptif('Value');
        $fixture->setLocalisation('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/entreprise');
        self::assertSame(0, $this->entrepriseRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
