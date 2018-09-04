########
Services
########

=======
Service
=======

Service entity in Servitiom represents microservice application, who can be used by registered tenants.
It can be deployed in many instances with unique custom properties like replicas count, resources limits.

================
Service Instance
================

Service instance in Servitiom represents unique deployed service in specified version and assigned to tenant. 
One tenant can have only one instance of service.

==================
Service Versioning
==================

Service can have multiply registered versions.
Each version contains jobs templates for instance and service contexts.
Template Schema: 

.. code-block:: yaml

    schemaVersion: "0.1"
    serviceVersion: "1.0.0"
    jobs:
        instance: 
            deploy:
                





=========================
ServiceTask
=========================

ServiceTask defining how execute some work in service like deploy instance.
Entity fields:

  * id - unique id in service
  * name - human friendly name of task
  * description - some text to describe task purpose
  * scope: instance | service 
  * versions:
    * default - special version to use when not explicity in request
    * <version_id>
      * template:  

.. code-block:: yaml

  id: <string>


Deploying service instance can consist of many steps,
with simple template you can describe what must be done to run instance of your service.
For more info about templating check: https://twig.symfony.com/

POST: https://<servitiom_api_uri>/v1/services
  id: "test"
  name: "test service",
  description: "simple service description bla bla bla" 

PUT: https://<servitiom_api_uri>/v1/services/test/variables/api_password
  <value>

PUT: https://<servitiom_api_uri>/v1/variables/DOCKER_REGISTRY
  <value>

PUT: https://<servitiom_api_uri>/v1/services/test/versions/<version>/instance

  
  {{set serviceAccountApiUri = "https://api.example.com/test/v1/service/accounts/#{InstanceInfo.customs.accountId}"}}
  schemaVersion: 1.0
  x-moduleCommon: &module_common
    name: "{{ServiceInfo.id}}_{{InstanceInfo.customs.accountId}}"
  steps:
    onDeploy:
      RegisterInApi:
        type: ApiCall
        applyCondition: {{InstanceInfo.customs.accountId == 100}}
        parameters:
          method: PUT
          uri: "{{serviceAccountApiUri}}"
          options:
            auth: ["username", "{{ServiceInfo.variables.api_password}}"]
      DeployModule:
        type: DockerServiceCreate
        parameters:
          <<: *module_common
          image: "{{Variables.DOCKER_REGISTRY}}_{{ServiceInfo.id}}_module:1.0.0"
          env:
            ACCOUNTID: "{{instanceInfo.customs.accountId}}"
    onRemove:
      UnregisterInApi:
        type: ApiCall
        parameters:
          method: DELETE
          uri: "{{serviceAccountApiUri}}"
      RemoveModule:
        type: DockerServiceRemove
        parameters:
          name: "{{moduleServiceName}}"


POST: https://<servitiom_api_uri>/v1/services/<serviceId>/instances
customs:
 accountId: 1
 extra2: "test"
 environment: "PROD"

 
------
Schema
------

.. code-block:: yaml

  apiVersion: v1
  name: # human friendly name of service 
  steps:
    upgrade_from: # represents list of steps to upgrade from specify version of service
      <version>:
        steps:
          <stepid>: # unique id of step
            type: # type of step must be one of supported step types like ApiCall
            name: # human friendly name of step, optional
            description: # some text to describe step operations, optional
            parameters: # some step depends parameters
      default:
    deploy: # represents list of steps to deploy new service instance
      <stepid>: # unique id of step
        type: # type of step must be one of supported step types like ApiCall
        name: # human friendly name of step, optional
        description: # some text to describe step operations, optional
        parameters: # some step depends parameters
    remove:  # represents list of steps to remove service instance
      <stepid>: # unique id of step
        type: # type of step must be one of supported step types like ApiCall
        name: # human friendly name of step, optional
        description: # some text to describe step operations, optional
        parameters: # some step depends parameters

:::::::
Example
:::::::

.. code-block:: yaml

  {{set moduleServiceName = "#{serviceInfo.name}_#{instanceInfo.customs.accountId}"}}
  {{set serviceAccountApiUri = "#{serviceInfo.subservices.api.baseUri}/service/accounts/#{instanceInfo.customs.accountId}"}}
  apiVersion: v1
  steps:
    deploy:
      RegisterInApi:
        type: ApiCall
        parameters:
          method: PUT
          uri: "{{serviceAccountApiUri}}"
      DeployModule:
        type: DockerServiceCreate
        parameters:
        name: "{{moduleServiceName}}"
        image: "{{serviceInfo.subservices.module.image}}"
        env:
          - ACCOUNTID="{{instanceInfo.customs.accountId}}"
    remove:
      UnregisterInApi:
        type: ApiCall
        parameters:
          method: DELETE
          uri: "{{serviceAccountApiUri}}"
      RemoveModule:
        type: DockerServiceRemove
        parameters:
          name: "{{moduleServiceName}}"
