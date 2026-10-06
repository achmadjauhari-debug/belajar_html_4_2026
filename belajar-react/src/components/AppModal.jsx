//props
import { Modal, Button } from "react-bootstrap";

const AppModal = ({
  show,
  onClose,
  onSubmit,
  isLoading = false,
  showFooter = true,
  size = "md",
  title,
  children,
  submitLabel = "Simpan",
  cancelLabel = "Batal",
}) => {
  return (
    <Modal show={show} onHide={onClose} size={size}>
      <Modal.Header closeButton>
        <Modal.Title>{title}</Modal.Title>
      </Modal.Header>
      <form onSubmit={onSubmit}>
        <Modal.Body>{children}</Modal.Body>
        {showFooter && (
          <Modal.Footer>
            <Button variant="secondary" onClick={onClose}>
              {cancelLabel}
            </Button>
            <Button type="submit" variant="primary" disabled={isLoading}>
              {isLoading ? 'Simpan...' : submitLabel}
            </Button>
          </Modal.Footer>
        )}
      </form>
    </Modal>
  );
};

export default AppModal;
