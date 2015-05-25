<?php

namespace T4webEmployees\Controller\User;

use T4webActionInjections\Mvc\Controller\AbstractActionController;
use Zend\Http\PhpEnvironment\Request as HttpRequest;
use T4webEmployees\ViewModel\SaveAjaxViewModel;
use T4webEmployees\Employee\Service\Update as UpdateService;
use League\Flysystem\Filesystem;

class SaveAjaxController extends AbstractActionController {

    public function defaultAction(HttpRequest $request, SaveAjaxViewModel $view, UpdateService $updateService, Filesystem $fileSystem)
    {
        if (!$request->isPost()) {
            return $view;
        }

        $params = $request->getPost()->toArray();

        $employee = $updateService->update($params['id'], $params);

        if (!$employee) {
            $view->setFormData($params);
            $view->setErrors($updateService->getErrors());
            return $view;
        }

        if(isset($params['removeAvatar']) && $fileSystem->has($params['removeAvatar'])) {
            $fileSystem->delete($params['removeAvatar']);
        }

        $params['employeeId'] = $employee->getId();
        $view->setFormData($params);

        return $view;
    }

}
