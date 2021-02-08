<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


class TaskController extends AbstractController
{
    /**
     *
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Task::class);
        return $this->render("index.html.twig", [
            "tasks" => $repository->findAll()
        ]);
    }
    public function show(Task $task)
    {

       return $this->render("show.html.twig", [
            "task" => $task     
        ]);
    }

    public function create(Request $request):response
    {
        if ($request->isMethod("POST")) {
            $task = new Task();
            $task->setTitle($request->request->get("title"));
            $six_digit_random_number = mt_rand(100000, 999999);
            $task->setDescription($request->request->get("description") . " " . $six_digit_random_number);
            $task->setScheduling(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute("task_show", ['id' => $task->getId()]);
        }

    return $this->render("new.html.twig");
    }
 
    public function edit(Request $request, Task $task):response
    {
        if ($request->isMethod("POST")) {
            $task->setTitle($request->request->get("title"));
            $task->setDescription($request->request->get("description"));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("task_show", ['id' => $task->getId()]);
        }

        return $this->render("edit.html.twig", [
            "task" => $task
        ]);
    }

    public function delete(Task $task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute("task_list");
    }
}