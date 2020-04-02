<?php
class CommandSubscribeUser extends Command {
	private $_command;
	private $_subDetail;
	private $_mapperSubscription;
	private $_subscription;
	private $_images;

	/**
	 * CommandSubscribeUser constructor.
	 *
	 * @param Subscription         $subscription
	 * @param SubscriptionDetail[] $subDetail
	 * @param array                $images
	 */
	public function __construct ($subscription, $subDetail, $images) {
		$this->_subscription = $subscription;
		$this->_dao = FactoryDao::createDaoSubscription();
		$this->_subDetail = $subDetail;
		$this->_mapperSubscription = FactoryMapper::createMapperSubscription();
		$this->_images = $images;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws FileIsNotImageException
	 * @throws ImageNotFoundException
	 */
	public function execute ():void {
		$subscription = $this->_dao->createSubscription($this->_subscription);
		$dtoSubscription = $this->_mapperSubscription->fromEntityToDto($subscription);
		$i = 0;
		while ($i < count($this->_images)) {
			$file = __DIR__ . '/' . ImageProcessor::saveImage($_FILES['image']['tmp_name'],
					$subscription->getId(), 'files/subscription/' . $subscription->getEmail());
			$this->_subDetail[$i]->setSubscription($subscription->getId());
			$this->_subDetail[$i]->setDocument($file);
			$i++;
		}
		if (!empty($this->_subDetail)) {
			$this->_command = FactoryCommand::createCommandAddSubscribeDetail($this->_subDetail);
			$this->_command->execute();
			$dtoSubscription->subsDetails = $this->_command->return();
		}
		$this->setData($dtoSubscription);
	}

	/**
	 * @return DtoSubscription
	 */
	public function return () {
		return $this->getData();
	}
}